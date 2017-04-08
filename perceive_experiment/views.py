from django.shortcuts import render
from django.shortcuts import redirect
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
