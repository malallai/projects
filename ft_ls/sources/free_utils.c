/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   free_utils.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 16:50:40 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 20:58:18 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	free_entries(t_entry *entry)
{
	free_array(entry->array);
	free(entry);
}

void	free_file(t_file *file)
{
	if (!file)
		return ;
	if (file->next)
		free_file(file->next);
	free(file);
}

void	free_array(char **array)
{
	int index;

	index = 0;
	if (!array)
		return ;
	while (array && array[index])
		free(array[index++]);
	if (array)
		free(array);
}

void	free_opt(t_opt *opt)
{
	free_entries(opt->entries);
	free_entries(opt->files);
	free_entries(opt->folders);
	free_file(opt->first);
	free(opt);
}
