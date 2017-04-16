#coding: utf-8
from django.db import models

class Table(models.Model):
	DAY_CHOICES = (
		(1, 'Понедельник'),
		(2, 'Вторник'),
		(3, 'Среда'),
		(4, 'Четверг'),
		(5, 'Пятница'),
		(6, 'Суббота'),
		(7, 'Воскресенье'),
	)
	title = models.CharField('Предмет', max_length=20)
	room = models.CharField('Аудитория', max_length=10)
	teacher = models.CharField('Преподаватель', max_length=20)
	day = models.SmallIntegerField('День', max_length=1, choices=DAY_CHOICES)
	begin = models.TimeField('Начало')
	ends = models.TimeField('Конец')
	parity = models.SmallIntegerField('Четность', default=0)
	def __unicode__(self):
		return self.title
	class Meta:
		ordering = ['begin']