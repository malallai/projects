/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   display.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/28 15:35:04 by bclerc            #+#    #+#             */
/*   Updated: 2019/03/16 13:41:29 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_ls.h"

int	ls_print(t_opt *opt)
{
	while (opt->folder)
	{
		if (!(opt->flag & F_ALL) && opt->folder->name[0] == '.')
		{
			opt->folder = opt->folder->next;
			continue;
		}
		ft_putstr(opt->folder->name);
		ft_putchar('\n');
		opt->folder = opt->folder->next;
	}
	while (opt->file)
	{
		if (!(opt->flag & F_ALL) && opt->file->name[0] == '.')
		{
			opt->file = opt->file->next;
			continue;
		}
		ft_putstr(opt->file->name);
		ft_putchar('\n');
		opt->file = opt->file->next;
	}
	return (0);
}
