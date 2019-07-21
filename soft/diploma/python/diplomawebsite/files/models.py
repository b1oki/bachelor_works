#coding: utf-8
from django.db import models
from django.conf import settings
from django.core.urlresolvers import reverse
from django.forms.models import modelform_factory

class StoreFile(models.Model):
	name = models.CharField('Имя файла', max_length=20)
	file = models.FileField('Файл', upload_to='.')
	sended = models.DateTimeField('Добавлен', auto_now_add=True)
	user_sender = models.ForeignKey(settings.AUTH_USER_MODEL, related_name='uploader_set', verbose_name='Отправитель')
	def get_absolute_url(self):
		return reverse('files:detail', args=[str(self.id)])
	def __unicode__(self):
		return self.name