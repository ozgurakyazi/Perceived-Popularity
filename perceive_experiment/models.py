from django.db import models
from django.contrib.auth.models import User
from django.contrib.postgres.fields import ArrayField

class Image(models.Model):
    id = models.AutoField(primary_key=True)
    file_name = models.CharField(max_length=30)
    def __str__(self):
        return 'Image name: ' + self.file_name + ' ID: '+ str(self.id)
class Configuration(models.Model):
    id = models.AutoField(primary_key=True)
    conf_name = models.CharField(max_length=50)
    images = ArrayField( models.CharField(max_length=30),)### this field contain the name of the images belong to the configuration.
    def __str__(self):
        return 'Conf name: ' + self.conf_name + ' ID: '+ str(self.id)
class LikeStat(models.Model):
    id = models.AutoField(primary_key=True)
    user_id = models.ForeignKey(User,on_delete=models.CASCADE)
    image = models.ForeignKey(Image, on_delete=models.CASCADE)
    like = models.IntegerField()
    configuration = models.ForeignKey(Configuration, on_delete=models.CASCADE)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)
    def __str__(self):
        return 'Like ID: '+ str(self.id)

class LikeConf(models.Model):
    id = models.AutoField(primary_key=True)
    image = models.ForeignKey(Image, on_delete=models.CASCADE)
    conf = models.ForeignKey(Configuration, on_delete=models.CASCADE)
    artificial_like = models.IntegerField()
    artificial_dislike = models.IntegerField()
    def __str__(self):
        return 'Image name: ' + self.image.file_name + ' Conf Name: '+ self.conf.conf_name+ ' ID: '+ str(self.id)

class UserInfo(models.Model):
    GENDER = (("ML","MALE"), ("FM", "Female"), ("O", "Other"),("NS", "Not Specified"))
    user = models.OneToOneField(User)
    age = models.IntegerField()
    gender = models.CharField(max_length=13, choices=GENDER, default="NS")
