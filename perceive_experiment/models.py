from django.db import models
from django.contrib.auth.models import User

class Image(models.Model):
    id = models.AutoField(primary_key=True)
    file_name = models.CharField(max_length=30)

class LikeStat(models.Model):
    id = models.AutoField(primary_key=True)
    user_id = models.ForeignKey(User,on_delete=models.CASCADE)
    image = models.ForeignKey(Image, on_delete=models.PROTECT)
    like = models.IntegerField()
    configuration = models.IntegerField()
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)
