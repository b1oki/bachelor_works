from django.conf.urls import patterns, url
from timetable import views

urlpatterns = patterns('',
	url(r'^$', views.ThisDay.as_view(), name='index'),
	url(r'^day/([1-7])/$', views.AnotherDay.as_view(), name='day'),
)