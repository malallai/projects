/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   parser.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 14:35:59 by malallai          #+#    #+#             */
/*   Updated: 2019/04/01 15:13:09 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int			set_flag(char c_flag, t_opt *opt)
{
	int		bi;

	bi = ft_findchar(opt->flags, c_flag);
	if (bi > -1)
	{
		opt->flag |= 1 << bi;
		return (1);
	}
	else
		return (bad_option(opt, c_flag));
}

int			parse(char **argv, t_opt *opt)
{
	int		i;
	int		b;

	if (!argv || argv[1][0] != '-')
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

void		set_main_files(t_opt *opt, int argc, char **argv, int a_index)
{
	int		index;
	t_file	*file;
	t_file	*tmp;

	index = 0;
	if (a_index == argc)
		opt->main = new_file(0, ".", "");
	while (a_index < argc)
	{
		file = new_file(index, argv[a_index++], NULL);
		if (!exist(file))
			print_nexist(opt, file);
		else
		{
			if (index++)
			{
				file->prev = tmp;
				tmp->next = file;
			}
			else
				opt->main = file;
			tmp = file;
		}
	}
	opt->main_count = index;
}
