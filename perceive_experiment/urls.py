from django.conf.urls import url
from . import views

urlpatterns = [
    url(r'^$', views.vote_page, name='vote_page'),
    url(r'^like_dislike$', views.like_dislike, name='like_dislike'),
]
