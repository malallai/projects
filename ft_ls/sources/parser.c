/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   parser.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 17:32:14 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 16:45:28 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		set_flag(char c_flag, t_opt *opt)
{
	int		bi;

	bi = ft_findchar("lRart", c_flag);
	if (bi > -1)
	{
		opt->flag |= 1 << bi;
		return (1);
	}
	else
	{
		ft_putstr("ft_ls: illegal option -- ");
		ft_putchar(c_flag);
		ft_putchar('\n');
		ft_putstr("usage: ft_ls [-lRart] [file ...]\n");
		free_opt(opt);
		exit(1);
	}
}

int		parse(char **argv, t_opt *opt)
{
	int		i;
	int		b;

	if (opt->entries->count == 1 || !argv || argv[1][0] != '-')
		return (1);
	i = 1;
	while (argv[i])
	{
		if (argv[i][0] != '-')
			return (i);
		b = 0;
		while (argv[i][++b])
			set_flag(argv[i][b], opt);
		i++;
	}
	return (i);
}
