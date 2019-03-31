#include <ft_ls.h>

void    swap(t_file *a, t_file *b)
{
    t_file  tmp;

    if (!a || !b)
        return ;
    tmp = *a;
    swap_item(&a, b);
    swap_item(&b, &tmp);
}

void    swap_item(t_file **a, t_file *cpy)
{
    (*a)->name = cpy->name;
    (*a)->path = cpy->path;
    (*a)->date = cpy->date;
    (*a)->dirent = cpy->dirent;
    (*a)->name_size = cpy->name_size;
    (*a)->millis = cpy->millis;
    (*a)->stat = cpy->stat;
}
