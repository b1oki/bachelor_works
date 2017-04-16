#coding: utf-8
from django.db import models
from django.conf import settings
from django.core.urlresolvers import reverse

class Post(models.Model):
	message = models.CharField('Сообщение', max_length=255)
	user_sender = models.ForeignKey(settings.AUTH_USER_MODEL, related_name='post_sender_set', verbose_name='Автор')
	sended = models.DateTimeField('Отправлено', auto_now_add=True)
	def __unicode__(self):
		return self.message
	def get_absolute_url(self):
		return reverse('forum:post_detail', args=[self.id])