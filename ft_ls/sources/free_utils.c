/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   free_utils.c                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 16:50:40 by malallai          #+#    #+#             */
/*   Updated: 2019/03/16 19:09:38 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	free_entries(t_entry *entry)
{
	if (!entry)
		return ;
	if (entry->next)
		free_entries(entry->next);
	free(entry);
}

void	free_array(char **array)
{
	int index;

	index = 0;
	if (!array)
		return ;
	while (array && array[index])
	{
		free(array[index]);
		index++;
	}
	if (array)
		free(array);
}

void	free_opt(t_opt *opt)
{
	free_array(opt->argv);
	free_array(opt->folders);
	free_array(opt->files);
	free_entries(opt->first_entry);
	free(opt);
}
