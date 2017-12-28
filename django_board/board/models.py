from __future__ import unicode_literals
from django.utils.encoding import python_2_unicode_compatible

from django.db import models
from django.core.urlresolvers import reverse
from tagging.fields import TagField
from django.contrib.auth.models import User


# Create your models here.

@python_2_unicode_compatible
class Board(models.Model):
    title = models.CharField('TITLE', max_length=50)
    content = models.TextField('CONTENT')
    create_date = models.DateTimeField('Create Date', auto_now_add=True)
    owner = models.ForeignKey(User, null=True)
    tag = TagField()

    class Meta:
        ordering  = ('-create_date',)

    def __str__(self):
        return self.title

    def get_absolute_url(self):
        return reverse('blog:post_detail', args=(self.pk,))

    def save(self, *args, **kwargs):
        super(Board, self).save(*args, **kwargs)

    #def get_previous_post(self):
    #    return self.get_previous_by_create_date()

    #def get_next_post(self):
    #    return self.get_next_by_create_date()
