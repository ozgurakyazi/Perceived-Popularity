from django.shortcuts import render
from django.shortcuts import redirect
from django_ajax.decorators import ajax
from django.contrib.auth.decorators import login_required
from perceive_experiment.models import Image, LikeStat,Configuration,LikeConf

current_conf=Configuration.objects.get(conf_name="conf_1")  ##current configuration which is an entry in the configuration table.
# Create your views here.
def vote_page(request):
    if request.user.is_authenticated():
        image_names=[]
        like_counts=[]
        dislike_counts=[]
        like_status=[]

        for img_name in current_conf.images:
            temp_like_dislike = get_like_count(image_name=img_name, confg=current_conf)
            like_counts.append(temp_like_dislike[0])
            dislike_counts.append(temp_like_dislike[1])
            temp_like_stat=get_like_stat(image_name=img_name, confg=current_conf, user=request.user)
            like_status.append(temp_like_stat)

        print(like_counts)
        print(dislike_counts)
        image_names = current_conf.images
        return render(request, "vote_page.html",
            { "images_info":[
                {"image_names":image_names
                },
                {"like_counts":like_counts
                },
                {"dislike_counts":dislike_counts
                },
                {"like_status":like_status
                }
             ]
            }
        )
    else:
        return redirect("account_login")

@ajax
@login_required
def like_dislike(request):
    image_name = request.POST["image_name"]
    like_type = int(request.POST["like_or_dislike"])
    print(image_name)
    print(like_type)
    #if request.content.like_or_dislike == 1:
    #    pass
    result_like_stat=0
    try:
        like_stat = LikeStat.objects.get(user_id=request.user,image__file_name=image_name,configuration=current_conf)
        ## if execution here, then there is an already existing like or dislike
        print("here")
        print(like_type)
        print(like_stat.like)
        if like_type == like_stat.like: ## if pressed button and the already existing like status are same, then we delete whatever it is
            like_stat.delete()
            print("deleted")
            result_like_stat = 0
        else: ## if it is a like and user pressed dislike, then the entry is changed to the dislike, or vice versa
            like_stat.like = like_type
            like_stat.save()
            result_like_stat = like_type

        print("Like is Altered...")

    except:
        print("no Like or dislike")
        try:
            Image.objects.get(file_name=image_name)
            print("here")
            new_like_stat = LikeStat(user_id=request.user,image= Image.objects.get(file_name=image_name), like=like_type, configuration=current_conf)
            new_like_stat.save()
            result_like_stat = like_type
            print("Like/dislike Added!!")
        except:
            print("possible problem: image_name does not exist in the system")


    like_dislike = get_like_count(image_name, current_conf) ## first element in the return is like count, second one is dislike count

    return {
        "image_like_count": like_dislike[0],
        "image_dislike_count":like_dislike[1],
        "user_like_status":result_like_stat
    }

def get_like_count(image_name,confg):
    the_image = Image.objects.get(file_name=image_name)
    the_conf =confg
    art_like =0
    art_dislike =0
    try:
        like_conf = LikeConf.objects.get(image=the_image,conf=the_conf)
        art_like = like_conf.artificial_like ##find artificially added like
        art_dislike = like_conf.artificial_dislike  ##find artificially added dislike
    except:
        pass

    real_like = LikeStat.objects.filter(image=the_image, like=1, configuration=the_conf).count()
    real_dislike = LikeStat.objects.filter(image=the_image, like=-1, configuration=the_conf).count()

    result_like = art_like + real_like
    result_dislike = art_dislike + real_dislike

    return [result_like, result_dislike]

def get_like_stat(image_name, confg, user):
    result_like_stat = 0
    the_image = Image.objects.get(file_name=image_name)
    try:
        like_obj = LikeStat.objects.get(user_id=user, image=the_image,configuration=confg )
        result_like_stat = like_obj.like
    except:
        pass

    return result_like_stat
