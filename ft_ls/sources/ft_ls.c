/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:19:35 by malallai          #+#    #+#             */
/*   Updated: 2019/03/21 00:37:17 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		main(int argc, char **argv)
{
	t_opt	*opt;
	int		i;

	opt = new_opt();
	if (argc == 1)
		add_file(opt->entries, ft_strdup("."), NULL);
	else
	{
		i = parse(argv, opt);
		set_opt_folders(opt, argc, argv, i);
		quicksort(opt->entries, 0, opt->entries->count - 1);
	}
	split_entries(opt);
	print_ls(opt);
	free_opt(opt);
	return (0);
}
