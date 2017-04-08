from django.shortcuts import render
from django.shortcuts import redirect
from django_ajax.decorators import ajax
from django.contrib.auth.decorators import login_required
from perceive_experiment.models import Image, LikeStat

current_configuration=1 ##special number for each configuration in the system
# Create your views here.
def vote_page(request):
    if request.user.is_authenticated():
        return render(request, "vote_page.html",
            { "images_info":[
                {"image_ids":[
                    1,2,3,4,5
                ]
                },
                {"like_counts":[
                    1,2,3,2,1
                ]
                },
                {"dislike_counts":[
                    1,0,3,2,1
                ]
                },
                {"like_status":[
                    -1,0,0,1,1
                ]
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
    like_type = request.POST["like_or_dislike"]
    print(image_name)
    print(like_type)
    #if request.content.like_or_dislike == 1:
    #    pass
    result_like_stat=0
    try:
        like_stat = LikeStat.objects.get(user_id=request.user,image__file_name=image_name)
        ## if execution here, then there is an already existing like or dislike
        if like_type == int(like_stat.like): ## if pressed button and the already existing like status are same, then we delete whatever it is
            like_stat.delete()
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
            new_like_stat = LikeStat(user_id=request.user,image= Image.objects.get(file_name=image_name), like=like_type, configuration=current_configuration)
            new_like_stat.save()
            print("Like/dislike Added!!")
        except:
            print("possible problem: image_name does not exist in the system")


    return {
        "image_like_count": 1,
        "image_dislike_count":2,
        "user_like_status":-1
    }
