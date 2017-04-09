from django.db import models
from django.contrib.auth.models import User
from django.contrib.postgres.fields import ArrayField

class Image(models.Model):
    id = models.AutoField(primary_key=True)
    file_name = models.CharField(max_length=30)

class Configuration(models.Model):
    id = models.AutoField(primary_key=True)
    conf_name = models.CharField(max_length=50)
    images = ArrayField( models.CharField(max_length=30),)### this field contain the name of the images belong to the configuration.

class LikeStat(models.Model):
    id = models.AutoField(primary_key=True)
    user_id = models.ForeignKey(User,on_delete=models.CASCADE)
    image = models.ForeignKey(Image, on_delete=models.CASCADE)
    like = models.IntegerField()
    configuration = models.ForeignKey(Configuration, on_delete=models.CASCADE)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)


class LikeConf(models.Model):
    id = models.AutoField(primary_key=True)
    image = models.ForeignKey(Image, on_delete=models.CASCADE)
    conf = models.ForeignKey(Configuration, on_delete=models.CASCADE)
    artificial_like = models.IntegerField()
    artificial_dislike = models.IntegerField()
