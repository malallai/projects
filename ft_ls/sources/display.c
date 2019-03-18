/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   display.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/17 16:13:29 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 16:13:29 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	display(t_opt *opt, t_infos *infos, int size_max)
{
	int i;

	i = 0;
	if (has_flag(opt, F_DETAIL))
		return (display_details(opt, infos, size_max));
	if (!has_flag(opt, F_ALL) && ft_strequ(&infos->name[0], "."))
		return ;
	ft_putstr(infos->name);
	while (i++ < size_max + 2)
		ft_putstr(" ");
}

void	display_details(t_opt *opt, t_infos *infos, int size_max)
{
	(void)opt;
	(void)infos;
	(void)size_max;
}
