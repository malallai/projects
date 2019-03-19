/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   list.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/11 14:02:57 by malallai          #+#    #+#             */
/*   Updated: 2019/03/11 14:11:53 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "./brycefdp.h"

t_file	*ft_newlist(char *name)
{
	t_file *new;

	new = (t_file *)malloc(sizeof(t_file *));
	new->name = ft_strdup(name);
	new->next = NULL;
	return (new);
}

t_file	*ft_addlist(t_file *file, char *name)
{
	t_file *new;

	new = ft_newlist(name);
	file->next = new;
	return (new);
}

void	ft_freelist(t_file *file)
{
	while (file)
	{
		free(file->name);
		free(file);
		file = file->next;
	}
}
