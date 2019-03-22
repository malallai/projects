/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sort.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/18 15:29:16 by malallai          #+#    #+#             */
/*   Updated: 2019/03/22 15:40:23 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	swap(t_file *a, t_file *b)
{
	char			*name_tmp;
	struct dirent	*dirent_tmp;
	int				size_tmp;
	time_t			millis_tmp;
	char			*date_tmp;

	if (!a || !b)
		return ;
	name_tmp = a->name;
	dirent_tmp = a->dirent;
	size_tmp = a->name_size;
	millis_tmp = a->millis;
	date_tmp = a->date;
	a->name = b->name;
	a->dirent = b->dirent;
	a->name_size = b->name_size;
	a->millis = b->millis;
	a->date = b->date;
	b->name = name_tmp;
	b->dirent = dirent_tmp;
	b->name_size = size_tmp;
	b->millis = millis_tmp;
	b->date = date_tmp;
}

void	sort(t_opt *opt, t_entry *entry, int low, int high)
{
	if (has_flag(opt, F_TIME))
		sort_time(entry, low, high);
	else
		sort_ascii(entry, low, high);
}

void	sort_ascii(t_entry *entry, int low, int high)
{
	int		pivot;
	int		i;
	int		j;

	if (low < high)
	{
		pivot = low;
		i = low;
		j = high;
		while (i < j)
		{
			while (i <= high && compare(0, get_file(entry->first, i), \
				get_file(entry->first, pivot), 1))
				i++;
			while (j >= low && compare(0, get_file(entry->first, j), \
				get_file(entry->first, pivot), 0))
				j--;
			if (i < j)
				swap(get_file(entry->first, i), get_file(entry->first, j));
		}
		swap(get_file(entry->first, j), get_file(entry->first, pivot));
		sort_ascii(entry, low, j - 1);
		sort_ascii(entry, j + 1, high);
	}
}

void	sort_time(t_entry *entry, int low, int high)
{
	int		pivot;
	int		i;
	int		j;

	if (low < high)
	{
		pivot = low;
		i = low;
		j = high;
		while (i < j)
		{
			while (i <= high && compare(1, get_file(entry->first, i), \
				get_file(entry->first, pivot), 1))
				i++;
			while (j >= low && compare(1, get_file(entry->first, j), \
				get_file(entry->first, pivot), 0))
				j--;
			if (i < j)
				swap(get_file(entry->first, i), get_file(entry->first, j));
		}
		swap(get_file(entry->first, j), get_file(entry->first, pivot));
		sort_time(entry, low, j - 1);
		sort_time(entry, j + 1, high);
	}
}

int		compare(int t, t_file *f1, t_file *f2, int i)
{
	if (t)
	{
		if (f1->millis == f2->millis)
			return (ft_strcmp(f1->name, f2->name) > 0);
		return (i ? f1->millis >= f2->millis : f1->millis < f2->millis);
	}
	else
		return (i ? ft_strcmp(f1->name, f2->name) <= 0 \
			: ft_strcmp(f1->name, f2->name) > 0);
	return (0);
}
