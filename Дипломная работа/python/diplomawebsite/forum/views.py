from django.views.generic import DetailView, ListView
from django.views.generic.edit import CreateView
from django.core.urlresolvers import reverse
from forum.models import Post
from django.contrib.auth.models import User
from django.db.models import Q

class PostListView(ListView):
	model = Post
class PostDetailView(DetailView):
	model = Post
class PostAddView(CreateView):
	model = Post
	fields = ['message']
	def get_form(self, form_class):
		form = super(PostAddView, self).get_form(form_class)
		form.instance.user_sender_id = self.request.user.id
		return form