from django.views.generic import DetailView, ListView
from django.views.generic.edit import CreateView
from accounts.models import Message
from django.contrib.auth.models import User
from django.db.models import Q

class ProfileView(DetailView):
	model = User
class UserProfileView(ListView):
	model = User
	def get_queryset(self):
		return User.objects.filter(id=self.request.user.id)
class MessageList(ListView):
	model = Message
	def get_queryset(self):
		return Message.objects.filter(Q(user_reciver_id=self.request.user.id) | Q(user_sender_id=self.request.user.id)).order_by('-sended')
class MessageView(DetailView):
	model = Message
class MessageSendView(CreateView):
	model = Message
	fields = ['message', 'user_reciver']
	def get_form(self, form_class):
		form = super(MessageSendView, self).get_form(form_class)
		form.instance.user_sender_id = self.request.user.id
		return form
class ProfileSignup(CreateView):
	model = User
	fields = ['username', 'password', 'first_name', 'last_name', 'email']