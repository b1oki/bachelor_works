from django.conf.urls import patterns, url
from files import views

urlpatterns = patterns('',
	url(r'^$', views.FileListView.as_view(), name='index'),
	url(r'^detail/(?P<pk>\d+)/$', views.FileDetailView.as_view(), name='detail'),
	url(r'^upload/$', views.FileUploadView.as_view(), name='upload'),
)