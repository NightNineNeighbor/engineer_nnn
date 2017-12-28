from django.views.generic import ListView, DetailView, TemplateView

from board.models import Board
from tagging.models import Tag, TaggedItem
from tagging.views import TaggedObjectList

from django.views.generic.edit import FormView
from board.forms import BoardSearchForm
from django.db.models import Q
from django.shortcuts import render

from django.views.generic.edit import CreateView, UpdateView, DeleteView
from django.core.urlresolvers import reverse_lazy
from mysite.views import LoginRequiredMixin


# Create your views here.

#--- ListView
class BoardLV(ListView) :
    model = Board
    #context_object_name = 'posts'
    paginate_by = 7

#--- DetailView
class BoardDV(DetailView) :
    model = Board

#-- Tag
class TagTV(TemplateView) :
    template_name = 'tagging/tagging_cloud.html'

class BoardTOL(TaggedObjectList) :
    model = Board
    template_name = 'tagging/tagging_board_list.html'

#--- FormView
class SearchFormView(FormView):
    form_class = BoardSearchForm
    template_name = 'board/board_search.html'

    def form_valid(self, form) :
        schWord = '%s' % self.request.POST['search_word']
        board_list = Board.objects.filter(Q(title__icontains=schWord) | Q(content__icontains=schWord)).distinct()

        context = {}
        context['form'] = form
        context['search_term'] = schWord
        context['object_list'] = board_list

        return render(self.request, self.template_name, context)

class BoardCreateView(LoginRequiredMixin, CreateView):
    model = Board
    fields = ['title', 'content', 'tag']
    success_url = reverse_lazy('board:list')

    def form_valid(self, form):
        form.instance.owner = self.request.user
        return super(BoardCreateView, self).form_valid(form)

class BoardChangeLV(LoginRequiredMixin, ListView):
    template_name = 'board/Board_change_list.html'

    def get_queryset(self):
        return Board.objects.filter(owner=self.request.user)

class BoardUpdateView(LoginRequiredMixin, UpdateView) :
    model = Board
    fields = ['title', 'content', 'tag']
    success_url = reverse_lazy('board:list')

class BoardDeleteView(LoginRequiredMixin, DeleteView) :
    model = Board
    success_url = reverse_lazy('board:list')
