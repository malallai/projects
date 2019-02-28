/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   print.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/28 13:19:12 by bclerc            #+#    #+#             */
/*   Updated: 2019/02/28 13:36:52 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

# include "ft_ls.h"

void	print_detail(t_folder *folder, t_opt *opt)
{
	//print detail
}
void	print(t_folder *folder, t_opt *opt)
{
	ft_putstr(folder->t_file->name);
	ft_putchar('\n');
}

void	printls(t_folder *folder, t_opt *opt)
{
	char id;
	int first;

	first = 1;
	id = -1;
	while (folder)
	{
		if(!(opt->flag & F_ALL) && folder->t_file->name[0] == '.')
		{
			folder = folder->next;
			continue;
		}
		if (opt->total > 1  && (id == -1 || folder->id != id))
		{
			first ? 0 : printf("\n");
			ft_putstr(folder->name);
			ft_putstr(":\n");
			first = 0;
			id = folder->id;
		}
		(opt->flag & F_DETAIL) ? print_detail(folder, opt) : print(folder, opt);
		folder = folder->next;
	}
	printf("\n");
}	