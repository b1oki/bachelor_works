#coding: utf-8
from django.views.generic import ListView
from django.db.models import Q
from timetable.models import Table
import datetime

def getNameOfDay(day):
	dayofWeek = ['понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота', 'воскресенье']
	return dayofWeek[int(day)-1]
def isParity():
	now_datetime = datetime.datetime.now()
	week = now_datetime.isocalendar()[1]
	isParity = 0
	if (week % 2 == 0): isParity = 1
	return isParity

class AnotherDay(ListView):
	template_name = 'timetable/day.html'
	def get_queryset(self):
		return Table.objects.filter(day=self.args[0])
	def get_context_data(self, *args, **kwargs):
		context = super(AnotherDay, self).get_context_data(**kwargs)
		context['today'] = getNameOfDay(self.args[0])
		return context

class ThisDay(ListView):
	def get_queryset(self):
		return Table.objects.filter(day=datetime.datetime.now().isoweekday()).filter(Q(parity=isParity) | Q(parity=0))
	def get_context_data(self, *args, **kwargs):
		context = super(ThisDay, self).get_context_data(**kwargs)
		context['cMin'] = datetime.datetime.now().minute
		context['cHour'] = datetime.datetime.now().hour
		return context