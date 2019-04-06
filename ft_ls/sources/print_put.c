/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   print_put.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 17:56:02 by malallai          #+#    #+#             */
/*   Updated: 2019/04/06 17:45:29 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	put_lnk(t_file *file)
{
	if (!S_ISLNK(file->infos->file_stat.st_mode))
		return ;
	ft_putstr(" -> ");
	ft_putstr(lsgetlink(file->path));
}

void	put_nbr(int nbr, int tab, int spaces, int max)
{
	int		index;
	char	*str;

	index = 0;
	str = ft_itoa(nbr);
	while (tab && index++ < spaces + (max - (int)ft_strlen(str)))
		ft_putchar(' ');
	ft_putstr(str);
	free(str);
}

void	put_str(char *str, int tab, int spaces, int max)
{
	int index;

	index = 0;
	while (tab && index++ < spaces + (max - (int)ft_strlen(str)))
		ft_putchar(' ');
	ft_putstr(str);
}
