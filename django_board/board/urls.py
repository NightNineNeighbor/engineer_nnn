from django.conf.urls import url
from board.views import *

urlpatterns = [
    url(r'^$', BoardLV.as_view(), name='list'),
    url(r'^(?P<pk>\d+)/$', BoardDV.as_view(), name='detail'),

    # Example: /tag/
    url(r'^tag/$', TagTV.as_view(), name='tag_cloud'),

    # Example: /tag/tagname/
    url(r'^tag/(?P<tag>[^/]+(?u))/$', BoardTOL.as_view(), name='tagged_object_list'),

    url (r'^search/$', SearchFormView.as_view(), name='search'),

    # Example: /add/
    url(r'^add/$',
        BoardCreateView.as_view(), name="add",
    ),

    # Example: /change/
    url(r'^change/$',
        BoardChangeLV.as_view(), name="change",
    ),

    # Example: /99/update/
    url(r'^(?P<pk>[0-9]+)/update/$',
        BoardUpdateView.as_view(), name="update",
    ),

    # Example: /99/delete/
    url(r'^(?P<pk>[0-9]+)/delete/$',
        BoardDeleteView.as_view(), name="delete",
    ),
]
