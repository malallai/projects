/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   sort.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/18 15:29:16 by malallai          #+#    #+#             */
/*   Updated: 2019/03/20 22:56:39 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	split_entries(t_opt *opt)
{
	int		index;
	t_file	*file;

	index = 0;
	file = opt->entries->first;
	while (index++ < opt->entries->count)
	{
		if (!exist(file->name))
		{
			print_nexist(file->name);
			file = file->next;
			continue ;
		}
		if (is_regular_file(file->name))
			add_file(opt->files, file->name, NULL);
		else if (is_folder(file->name))
			add_file(opt->folders, file->name, NULL);
		file = file->next;
	}
	max_size(opt);
}

void	max_size(t_opt *opt)
{
	t_file	*file;
	int		index;

	file = opt->files->first;
	index = 0;
	while (index++ < opt->files->count)
	{
		if (file->name_size > opt->files->max)
			opt->files->max = file->name_size;
		file = file->next;
	}
	index = 0;
	file = opt->folders->first;
	while (index++ < opt->folders->count)
	{
		if (file->name_size > opt->folders->max)
			opt->folders->max = file->name_size;
		file = file->next;
	}
}

void	swap(t_file *a, t_file *b)
{
	char			*name_tmp;
	struct dirent	*dirent_tmp;
	int				size_tmp;

	name_tmp = a->name;
	dirent_tmp = a->dirent;
	size_tmp = a->name_size;
	a->name = b->name;
	a->dirent = b->dirent;
	a->name_size = b->name_size;
	b->name = name_tmp;
	b->dirent = dirent_tmp;
	b->name_size = size_tmp;
}

void	quicksort(t_entry *entry, int low, int high)
{
	int 	pivot;
	int 	i;
	int 	j;

	if (low < high)
	{
		pivot = low;
		i = low;
		j = high;
		while (i < j)
		{
			while (ft_strcmp(get_file(entry->first, i)->name, \
				get_file(entry->first, pivot)->name) < 0 && i <= high)
				i++;
			while (ft_strcmp(get_file(entry->first, j)->name, \
				get_file(entry->first, pivot)->name) > 0 && j >= low)
				j--;
			if (i < j)
				swap(get_file(entry->first, i), get_file(entry->first, j));
		}
		swap(get_file(entry->first, j), get_file(entry->first, pivot));
		quicksort(entry, low, j - 1);
		quicksort(entry, j + 1, high);
	}
}
