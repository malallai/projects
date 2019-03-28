/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   lst.c                                              :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:23:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/23 18:54:03 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

t_file		*new_file(char *entry_name, char *name, struct dirent *dir)
{
	t_file	*file;
	char	*tmp;
	struct stat	pstat;


	file = (t_file *)malloc(sizeof(t_file *) * (sizeof(struct stat) + 11));
	file->next = NULL;
	file->prev = NULL;
	file->name = name;
	if (name[ft_strlen(name) - 1] == '/' || is_regular_file(name))
		tmp = ft_strdup(name);
	else
		tmp = ft_strjoin(name, "/");
	file->path = ft_strjoin(entry_name ? \
		entry_name : "", (tmp = ft_strdup(tmp)));
	file->dirent = dir;
	lstat(file->path, &pstat);
	file->stat = pstat;
	file->millis = file->stat.st_mtime;
	file->date = get_date(file->millis);
	file->name_size = (int)ft_strlen(name);
	free(tmp);
	return (file);
}

void		add_file(t_entry *entry, char *name, struct dirent *dir)
{
	t_file		*new;

	new = new_file(entry->name, name, dir);
	new->id = entry->count;
	if (!entry->init++)
		entry->file = (entry->first = new);
	else
	{
		new->prev = entry->file;
		entry->file->next = new;
		entry->file = new;
	}
	entry->count = entry->count + 1;
	if (entry->max < new->name_size)
		entry->max = new->name_size;
	entry->totalall = entry->totalall + new->stat.st_blocks;
	entry->total = entry->total + (name[0] == '.' ? 0 : new->stat.st_blocks);
	update_entry_sizes(new, entry->size, new->stat);
}

t_entry		*new_entry(void)
{
	t_entry	*entry;

	entry = (t_entry *)malloc(sizeof(t_entry *) * 11);
	entry->init = 0;
	entry->max = 0;
	entry->first = NULL;
	entry->count = 0;
	entry->total = 0;
	entry->totalall = 0;
	entry->name = NULL;
	entry->tmp_dir = NULL;
	entry->recurs = 0;
	entry->size = new_size();
	return (entry);
}

t_opt		*new_opt(void)
{
	t_opt	*opt;
	int		index;

	index = 0;
	opt = (t_opt *)malloc(sizeof(t_opt *) * 6);
	opt->flag = 0;
	opt->entries = new_entry();
	opt->files = new_entry();
	opt->folders = new_entry();
	opt->error = 0;
	opt->flags = ft_strdup("lRarts");
	return (opt);
}

t_infosize	*new_size(void)
{
	t_infosize	*size;

	size = (t_infosize *)malloc(sizeof(t_infosize *) * 6);
	size->blocks = 0;
	size->gid = 0;
	size->links = 0;
	size->size = 0;
	size->t = 0;
	size->uid = 0;
	return (size);
}
