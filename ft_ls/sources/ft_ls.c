/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:19:35 by malallai          #+#    #+#             */
/*   Updated: 2019/03/18 15:37:24 by malallai         ###   ########.fr       */
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
		opt->entries->a = malloc(sizeof(char *));
		opt->entries->a[0] = ft_strdup(".");
		opt->entries->a[1] = NULL;
	}
	else
	{
		i = parse(argv, opt);
		set_opt_folders(opt, argc, argv, i);
		quicksort(opt->entries->a, 0, opt->entries->count - 1);
		split_entries(opt);
	}
	read_files(opt);
	free_opt(opt);
	return (0);
}
