from django.conf.urls import patterns, url
from forum import views

urlpatterns = patterns('',
	url(r'^$', views.PostListView.as_view(), name='index'),
	url(r'^post/(?P<pk>\d+)/$', views.PostDetailView.as_view(), name='post_detail'),
	url(r'^addpost/$', views.PostAddView.as_view(), name='add_post'),
)