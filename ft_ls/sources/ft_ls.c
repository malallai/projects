/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 12:21:44 by malallai          #+#    #+#             */
/*   Updated: 2019/04/23 13:22:55 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		main(int argc, char **argv)
{
	t_opt		*opt;
	int			i;

	opt = init_opt();
	if (argc == 1)
	{
		opt->main->first = new_file(0, ".", opt->main);
		opt->main->file = opt->main->first;
		opt->main->count = 1;
	}
	else
	{
		i = parse(argv, opt);
		if (has_flag(opt, F_UNSORT))
			set_flag('a', opt);
		set_main_files(opt, argc, argv, i);
		ft_putnbrln(i);
		ft_putnbrln(argc);
		if (i != argc)
			sort(opt, opt->main, 0, opt->main->count);
	}
	ls(opt, has_flag(opt, F_REVERSE) \
		? opt->main->file : opt->main->first);
	return (exit_ftls(opt));
}
