/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:19:35 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 12:46:18 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		main(int argc, char **argv)
{
	t_opt	*opt;
	int		i;

	opt = new_opt();
	if (argc == 1)
	{
		opt->argv = malloc(sizeof(char *));
		opt->argv[0] = ft_strdup(".");
		opt->argv[1] = NULL;
		ls_read(opt);
	}
	else
	{
		i = parse(argv, opt);
		set_opt_folders(opt, argc, argv, i);
		ls_read(opt);
	}
	free_opt(opt);
	return (0);
}
