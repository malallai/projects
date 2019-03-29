/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   entries.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/22 14:27:44 by malallai          #+#    #+#             */
/*   Updated: 2019/03/22 14:27:44 by malallai         ###   ########.fr       */
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

void	update_entry_sizes(t_file *file, t_infosize *i, struct stat pstat)
{
	int len;
	struct passwd	*uid;
	struct group	*gid;
	
	len = 0;
	uid = getpwuid(pstat.st_uid);
	gid = getgrgid(pstat.st_gid);
	i->blocks = (len = ft_len((int)pstat.st_blocks)) > i->blocks ? len : i->blocks;
	i->links = (len = ft_len((int)pstat.st_nlink)) > i->links ? len : i->links;
	i->uid = (len = (int)ft_strlen(uid->pw_name)) > i->uid ? len : i->uid;
	i->gid = (len = (int)ft_strlen(gid->gr_name)) > i->gid ? len : i->gid;
	i->size = (len = ft_len((int)pstat.st_size)) > i->size ? len : i->size;
	i->t = (len = (int)ft_strlen(file->date)) > i->t ? len : i->t;
}
