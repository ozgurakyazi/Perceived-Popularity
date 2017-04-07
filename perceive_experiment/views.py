from django.shortcuts import render

# Create your views here.
def vote_page(request):
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
