/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:19:35 by malallai          #+#    #+#             */
/*   Updated: 2019/03/16 19:36:35 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		main(int argc, char **argv)
{
	/*t_opt	*opt;
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
	free_opt(opt);*/
	ft_putnbrln(ft_strcmp(argv[1], argv[2]));
	(void)argc;
	return (0);
}
