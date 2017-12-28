from django.contrib import admin
from board.models import Board

# Register your models here.

class BoardAdmin(admin.ModelAdmin):
    list_display  = ('title', 'create_date')
    list_filter   = ('create_date',)
    search_fields = ('title', 'content')

admin.site.register(Board, BoardAdmin)
