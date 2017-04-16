from django.conf.urls import patterns, include, url
from django.contrib import admin
admin.autodiscover()
from django.views.generic import RedirectView

urlpatterns = patterns('',
    url(r'^admin/', include(admin.site.urls)),
	url(r'^$', RedirectView.as_view(url='timetable/', permanent=False), name='index'),
	url(r'^accounts/', include('accounts.urls', namespace='accounts')),
	url(r'^timetable/', include('timetable.urls', namespace='timetable')),
	url(r'^info/', include('info.urls', namespace='info')),
	url(r'^forum/', include('forum.urls', namespace='forum')),
	url(r'^files/', include('files.urls', namespace='files')),
)