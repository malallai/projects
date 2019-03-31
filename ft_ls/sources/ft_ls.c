/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:19:35 by malallai          #+#    #+#             */
/*   Updated: 2019/03/23 18:41:09 by malallai         ###   ########.fr       */
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
		sort(opt, opt->entries, 0, opt->entries->count - 1);
	}
	split_entries(opt);
	print_ls(opt);
	if (argc == 1)
		free(opt->entries->first->name);
	return (exit_ftls(opt));
}
