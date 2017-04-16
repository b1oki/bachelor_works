from django.views.generic import ListView, DetailView
from django.views.generic.edit import CreateView
from files.models import StoreFile
from django.contrib.auth.models import User

class FileListView(ListView):
	model = StoreFile
class FileDetailView(DetailView):
	model = StoreFile
class FileUploadView(CreateView):
	model = StoreFile
	fields = ['name', 'file']
	def get_form(self, form_class):
		form = super(FileUploadView, self).get_form(form_class)
		form.instance.user_sender_id = self.request.user.id
		return form