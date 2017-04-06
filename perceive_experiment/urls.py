from django.conf.urls import url
from . import views

urlpatterns = [
    url(r'^$', views.vote_page, name='vote_page'),
]
