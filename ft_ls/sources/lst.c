/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   lst.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:23:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/21 00:05:58 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_file		*new_file(char *name, struct dirent *dir)
{
	t_file *file;

	file = (t_file *)malloc(sizeof(t_file *) * 5);
	file->next = NULL;
	file->name = name;
	file->dirent = dir;
	file->name_size = (int)ft_strlen(name);
	return (file);
}

void		add_file(t_entry *entry, char *str, struct dirent *dir)
{
	t_file	*new;

	new = new_file(str, dir);
	if (!entry->init)
	{
		entry->init = 1;
		entry->first = new;
		entry->file = entry->first;
	}
	else
	{
		entry->file->next = new;
		entry->file = new;
	}
	new->id = entry->count;
	entry->count = entry->count + 1;
	if (entry->max < new->name_size)
		entry->max = new->name_size;
}

t_entry		*new_entry(void)
{
	t_entry	*entry;

	entry = (t_entry *)malloc(sizeof(t_entry *) * 6);
	entry->init = 0;
	entry->max = 0;
	entry->first = NULL;
	entry->count = 0;
	return (entry);
}

t_opt		*new_opt(void)
{
	t_opt	*opt;
	int		index;

	index = 0;
	opt = (t_opt *)malloc(sizeof(t_opt *) * 5);
	opt->flag = 0;
	opt->entries = new_entry();
	opt->files = new_entry();
	opt->folders = new_entry();
	opt->tmp_dir = new_entry();
	return (opt);
}

t_file		*get_file(t_file *first, int id)
{
	if (!first)
		return (NULL);
	if (first->id == id)
		return (first);
	return (get_file(first->next, id));
}
