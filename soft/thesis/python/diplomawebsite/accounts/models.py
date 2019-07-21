#coding: utf-8
from django.db import models
from django.conf import settings
from django.core.urlresolvers import reverse

class Message(models.Model):
	message = models.TextField('Сообщение')
	sended = models.DateTimeField('Отправлено', auto_now_add=True)
	user_reciver = models.ForeignKey(settings.AUTH_USER_MODEL, related_name='reciver_set', verbose_name='Получатель')
	user_sender = models.ForeignKey(settings.AUTH_USER_MODEL, related_name='sender_set', verbose_name='Отправитель')
	def get_absolute_url(self):
		return reverse('accounts:message', args=[str(self.id)])
	def __unicode__(self):
		return self.message