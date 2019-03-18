/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   error.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/18 13:45:42 by malallai          #+#    #+#             */
/*   Updated: 2019/03/18 14:15:11 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include <ft_ls.h>

void	print_nexist(char *path)
{
	ft_putstr("ft_ls: ");
	ft_putstr(path);
	ft_putendl(": No such file or directory");
}
