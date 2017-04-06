from django.shortcuts import render

# Create your views here.
def vote_page(request):
    return render(request, "vote_page.html")
