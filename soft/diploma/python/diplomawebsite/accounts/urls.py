from django.conf.urls import patterns, url
from accounts import views
from django.views.generic import RedirectView

urlpatterns = patterns('',
	url(r'^$', RedirectView.as_view(url='profile/', permanent=False), name='index'),
	url(r'^signup/$', views.ProfileSignup.as_view(), name='signup'),
	url(r'^login/$', 'django.contrib.auth.views.login', {'template_name': 'accounts/login.html'}, name='login'),
	url(r'^logout/$', 'django.contrib.auth.views.logout', {'template_name': 'accounts/logout.html'}, name='logout'),
	url(r'^profile/$', views.UserProfileView.as_view(), name='user_profile'),
	url(r'^profile/(?P<pk>\d+)/$', views.ProfileView.as_view(), name='profile'),
	url(r'^messages/$', views.MessageList.as_view(), name='messages'),
	url(r'^messages/(?P<pk>\d+)/$', views.MessageView.as_view(), name='message'),
	url(r'^messages/send/$', views.MessageSendView.as_view(), name='message_send'),
)