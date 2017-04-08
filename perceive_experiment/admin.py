from django.contrib import admin
from perceive_experiment.models import LikeStat,Image
# Register your models here.

class AdminModels(admin.ModelAdmin):
    admin.site.register(LikeStat)
    admin.site.register(Image)
