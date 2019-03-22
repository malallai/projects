/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   lst.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:23:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/22 15:09:06 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_file		*new_file(char *name, struct dirent *dir)
{
	t_file *file;

	file = (t_file *)malloc(sizeof(t_file *) * 8);
	file->next = NULL;
	file->prev = NULL;
	file->name = name;
	file->dirent = dir;
	file->date = NULL;
	file->millis = 0;
	file->name_size = (int)ft_strlen(name);
	return (file);
}

void		add_file(t_entry *entry, char *str, struct dirent *dir)
{
	t_file		*new;
	struct stat	pstat;

	lstat(get_path(entry->name, str), &pstat);
	new = new_file(str, dir);
	new->id = entry->count;
	new->date = get_date((new->millis = pstat.st_mtime));
	if (!entry->init)
	{
		entry->init = 1;
		entry->first = new;
		entry->file = entry->first;
	}
	else
	{
		new->prev = entry->file;
		entry->file->next = new;
		entry->file = new;
	}
	entry->count = entry->count + 1;
	if (entry->max < new->name_size)
		entry->max = new->name_size;
	entry->totalall = entry->totalall + pstat.st_blocks;
	entry->total = entry->total + (str[0] == '.' ? 0 : pstat.st_blocks);
	update_entry_sizes(new, &(entry->size), str, pstat);
}

t_entry		*new_entry(void)
{
	t_entry	*entry;

	entry = (t_entry *)malloc(sizeof(t_entry *) * (sizeof(t_infosize) + 11));
	entry->init = 0;
	entry->max = 0;
	entry->first = NULL;
	entry->count = 0;
	entry->total = 0;
	entry->totalall = 0;
	entry->name = NULL;
	entry->tmp_dir = NULL;
	entry->recurs = 0;
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
	return (opt);
}

t_file		*get_file(t_file *first, int id)
{
	if (!first || id < 0)
		return (NULL);
	if (first->id == id)
		return (first);
	return (get_file(first->next, id));
}
