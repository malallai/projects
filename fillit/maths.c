/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   maths.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/01/13 17:03:07 by malallai          #+#    #+#             */
/*   Updated: 2019/01/23 18:35:53 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "fillit.h"

int		ft_sqrt(int n)
{
	int size;

	size = 2;
	while (size * size < n)
		size++;
	return (size);
}

int		is_valid_char(char c, int i)
{
	if (!i)
		return (c == '\n' ? 0 : 1);
	return (c == '.' || c == '#' || c == '\n');
}
