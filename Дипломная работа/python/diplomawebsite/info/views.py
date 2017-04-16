from django.views.generic import ListView
from info.models import Info

class Information(ListView):
	def get_queryset(self):
		return Info.objects.all();