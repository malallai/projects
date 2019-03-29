/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   free_utils.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 16:50:40 by malallai          #+#    #+#             */
/*   Updated: 2019/03/22 16:05:05 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	free_entries(t_entry *entry)
{
	if (!entry)
		return ;
	free_file(entry->first);
	free_entries(entry->tmp_dir);
	free(entry);
}

void	free_file(t_file *file)
{
	if (!file)
		return ;
	if (file->date)
		free(file->date);
	if (file->next)
		free_file(file->next);
	free(file);
}

void	free_infos(t_infos *infos)
{
	if (!infos)
		return ;
	if (infos->mode)
		free(infos->mode);
	free(infos);
}

void	free_opt(t_opt *opt)
{
	free_entries(opt->entries);
	free_entries(opt->files);
	free_entries(opt->folders);
	free(opt->flags);
	free(opt);
}
