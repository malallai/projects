/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 12:21:44 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 17:41:50 by malallai         ###   ########.fr       */
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
		opt->main->first = new_file(0, ".", "");
		opt->main->file = opt->main->first;
		opt->main->count = 1;
	}
	else
	{
		i = parse(argv, opt);
		set_main_files(opt, argc, argv, i);
		sort(opt, opt->main, 0, opt->main->count - 1);
	}
	return (exit_ftls(opt));
}
