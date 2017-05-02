from django.conf.urls import url
from . import views

urlpatterns = [
    url(r'^$', views.vote_page, name='vote_page'),
    url(r'^like_dislike$', views.like_dislike, name='like_dislike'),
    url(r'^about_you$', views.user_info, name='user_info_page'),
    url(r'^info_submit$', views.info_submit, name='info_submit'),
    url(r'^thank_you$', views.thank_you, name='thank_you'),
]
