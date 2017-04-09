from django.contrib import admin
from perceive_experiment.models import LikeStat,Image,Configuration,LikeConf
# Register your models here.

class AdminModels(admin.ModelAdmin):
    admin.site.register(LikeStat)
    admin.site.register(Image)
    admin.site.register(LikeConf)
    admin.site.register(Configuration)
