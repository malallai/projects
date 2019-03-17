/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   reader.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 17:46:34 by malallai          #+#    #+#             */
/*   Updated: 2019/03/17 17:13:10 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

int		ls_read(t_opt *opt)
{
	DIR				*dir;
	struct dirent	*sd;

	if (!(dir = opendir(opt->entries->array[0])))
	{
		ft_putstr("ft_ls: ");
		ft_putstr(opt->entries->array[0]);
		ft_putstr(": No such file or directory\n");
		return (1);
	}
	while ((sd = readdir(dir)))
	{
		add_file(opt, sd);
		ft_putcharln(get_dtype(sd->d_type));
	}
	closedir(dir);
	return (0);
}
