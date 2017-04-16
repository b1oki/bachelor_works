#coding: utf-8
from django.db import models

class Info(models.Model):
	title = models.CharField('Заголовок', max_length=30)
	text = models.CharField('Информация', max_length=200)
	def __unicode__(self):
		return self.title